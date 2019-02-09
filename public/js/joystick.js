let socket;
let serverOpened = false;
let manualMode = true;
let globalAddressRobot = "";

const manager = nipplejs.create(
  {
    zone: document.querySelector('#manager'),
    mode: 'static',
    position: {
      left: '50%',
      top: '50%'
    },
    color: '#171847',
    restOpacity: 0.8,
    size: 225
  }
);

// SELECTORS
const formSockets = document.querySelector('#sockets');
const formRobots = document.querySelector("#robots");
const btnOpenConnection = document.querySelector('#btnOpenConnection');
const btnCloseConnection = document.querySelector('#btnCloseConnection');
const alertSocket = document.querySelector('#alertSocket');
const btnDeleteSocket = document.querySelector('#btnDeleteSocket');
const selectChangeMode = document.querySelector('#mode');
const btnDeleteRobot = document.querySelector('#btnDeleteRobot');

// LISTENERS
btnOpenConnection.addEventListener("click", event => {
  event.preventDefault();
  let addressServer = formSockets.options[formSockets.selectedIndex].value;
  let addressRobot = formRobots.options[formRobots.selectedIndex].value;
  openConnection(addressServer, addressRobot);
});

btnDeleteSocket.addEventListener("click", event => {
  event.preventDefault();
  let address = formSockets.options[formSockets.selectedIndex].value;
  deleteSocket(address);
});

btnDeleteRobot.addEventListener("click", event => {
  event.preventDefault();
  let address = formRobots.options[formRobots.selectedIndex].value;
  deleteRobot(address);
});

selectChangeMode.addEventListener("change", event => {
  manualMode = !manualMode;
  loadJSON('changeMode.json')
    .then(data => {
      data.manualMode = manualMode;
      sendData(data);
    });
});

// *****************
// FONCTIONS SERVEUR
// *****************

/**
 * Ouverture d'une connexion avec le serveur
 *
 * @param {string} addressServer - L'addresse du serveur
 * @param {string} addressRobot - L'addresse du robot
 */
const openConnection = (addressServer, addressRobot) => {
  if (socket !== undefined) {
    socket.close();
  }

  socket = new WebSocket(`ws://${addressServer}`);
  alertSocket.textContent = `Connexion en cours à l'adresse ${addressServer}`;

  // Etablissement de la connexion
  socket.onopen = () => {
    initConnection(addressRobot);
  };

  // Réception des messages
  socket.onmessage = (event) => {
    let data = JSON.parse(event.data);
    treatement(data, addressServer);

  };

  // Fermeture de la connexion
  socket.onclose = () => {
    closeConnection();
  };
};

/**
 * Etablissation de la connexion au serveur
 * Envoie d'un message d'initialisation
 */
const initConnection = (addressRobot) => {
  globalAddressRobot = addressRobot;
  loadJSON("init.json")
    .then(data => {
      data.robot.ip = addressRobot;
      socket.send(JSON.stringify(data));
      serverOpened = true;
      btnCloseConnection.disabled = false;
      btnOpenConnection.disabled = true;
    });
};

/**
 * Fermeture de la connexion au serveur
 */
const closeConnection = () => {
  socket.close();
  serverOpened = false;
  alertSocket.className = "alert alert-danger";
  alertSocket.textContent = `Connexion fermée`;
  btnCloseConnection.disabled = true;
  btnOpenConnection.disabled = false;
};

/**
 * Traitement appliqué aux messages du serveur
 *
 * @param message {JSON} - Le message du serveur
 * @param addressServer {string} - L'addresse du serveur
 */
const treatement = (message, addressServer) => {
  switch (message.type) {
    case "init":
      alertSocket.textContent = `Connexion établie à l'adresse ${addressServer}`;
      alertSocket.className = "alert alert-success";
      break;
    case "sensors":
      let name = message.name;
      let temperature = message.data.temperature;
      let smoke = message.data.smoke;
      let humidity = message.data.humidity;

      Snackbar.show({
        text: `${name} -> Température : ${temperature} °C, Humidité : ${humidity} %, Fumée: ${smoke}`,
        pos: 'bottom-center',
        actionText: 'Fermer',
        backgroundColor: '#1C2331'
      });

      displayOnMap(message);

      break;

    case "alert":
      Snackbar.show({
        text: `Un intrus a été détecté`,
        pos: 'bottom-center',
        actionText: 'Fermer',
        backgroundColor: '#d63031',
        actionTextColor: '#FFF'
      });

      displayAlertOnMap();
      break;
  }
};

/**
 * Envoie d'informations au serveur
 *
 * @param data {JSON} - Les données à transmettre
 */
const sendData = (data) => {
  if (socket !== undefined) {
    socket.send(JSON.stringify(data));
  }
};


// *******************
// GESTION DU JOYSTICK
// *******************

/**
 * Gestion du joystick en utilisation
 */
manager.on('dir', (event, data) => {

  if (serverOpened && manualMode) {
    loadJSON('move.json')
      .then(json => {
        json.robot.ip = globalAddressRobot;
        json.data.x = data.instance.frontPosition.y * (-1);
        json.data.y = data.instance.frontPosition.x * (-1)
        json.data.power = data.force * 5;
        sendData(json);
      })
  }
});

/**
 * Gestion du joystick relaché
 */
manager.on('end', event => {
  if (serverOpened && manualMode) {
    loadJSON('move.json')
      .then(data => {
        data.robot.ip = globalAddressRobot;
        sendData(data)
      })
  }
});

// *****************
// ROTATION DU ROBOT
// *****************

/**
 * Rotation du robot à gauche
 */
const turnLeft = () => {
  if (serverOpened && manualMode) {
    loadJSON('rotation.json')
      .then(json => {
        json.data.rotate = 1;
        json.robot.ip = globalAddressRobot;
        sendData(json);
      });
  }
};

/**
 * Rotation du robot à droite
 */
const turnRight = () => {
  if (serverOpened && manualMode) {
    loadJSON('rotation.json')
      .then(json => {
        json.data.rotate = -1;
        json.robot.ip = globalAddressRobot;
        sendData(json);
      });
  }
};

/**
 * Arrêt de la rotation du robot
 */
const stopRotation = () => {
  if (serverOpened && manualMode) {
    loadJSON('rotation.json')
      .then(json => {
        json.robot.ip = globalAddressRobot;
        sendData(json);
      });
  }
};

// *********************
// FONCTIONS FORMULAIRES
// *********************

/**
 * Gestion de la db : ajout d'une nouvelle socket
 */
const postFormSocket = () => {
  let form = document.querySelector('#formNewSocket');
  let formData = new FormData(form);

  fetch('../../src/php/ajax/form.php', {method: "POST", body: formData})
    .then(response => response.text())
    .then(data => addOptionSocket(data))
    .catch(error => console.error(error));
};

/**
 * Gestion de la db : ajout d'un nouveau robot
 */
const postFormRobot = () => {
  let formData = new FormData(document.querySelector('#formNewRobot'));

  fetch('src/php/ajax/formRobot.php', {method: "POST", body: formData})
    .then(response => response.text())
    .then(data => addOptionRobot(data))
    .catch(error => console.error(error));
};

/**
 * Gestion du formulaire : ajout d'une nouvelle socket
 *
 * @param data {string} - La nouvelle socket à ajouter
 */
const addOptionSocket = (data) => {
  const form = document.querySelector('#formNewSocket');
  let select = document.querySelector("#sockets");
  let option = document.createElement("option");
  option.text = data;
  select.add(option);

  document.querySelector('#alertNewSocket').innerHTML =
    `<div class="alert alert-success alert-dismissible fade show" role="alert">
    L'adresse <strong>${data}</strong> a bien été ajoutée !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>`;

  form.reset();
};

/**
 * Gestion du formulaire : ajout d'une nouveau robot
 *
 * @param data {string} - Le nouveau robot à ajouter
 */
const addOptionRobot = (data) => {
  const form = document.querySelector('#formNewRobot');
  let select = document.querySelector("#robots");
  let option = document.createElement("option");
  option.text = data;
  select.add(option);

  document.querySelector('#alertNewRobot').innerHTML =
    `<div class="alert alert-success alert-dismissible fade show" role="alert">
    L'adresse <strong>${data}</strong> a bien été ajoutée !
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>`;

  form.reset();
};

/**
 * Suppresion d'une socket
 *
 * @param address {string} - L'adresse à supprimer
 */
const deleteSocket = (address) => {
  let data = new FormData();
  data.append("address", address);
  fetch('src/php/ajax/delete.php', {method: "POST", body: data})
    .then(response => {
      removeElement(address, "sockets")
    })
    .catch(error => console.error(error));
};


/**
 * Suppresion d'un robot
 *
 * @param address {string} - Le robot à supprimer
 */
const deleteRobot = (address) => {
  let data = new FormData();
  data.append("address", address);
  fetch('src/php/ajax/deleteRobot.php', {method: "POST", body: data})
    .then(response => {
      removeElement(address, 'robots')
    })
    .catch(error => console.error(error));
};

/**
 * Suppression d'une option dans un select
 *
 * @param option {string} - L'adresse à supprimer
 * @param id {number} - L'id du select
 */
const removeElement = (option, id) => {
  let select = document.querySelector("#" + id);
  for (let i in select.options) {
    if (select.options[i].value === option) {
      select.remove(i);
    }
  }
}

// ********************
// FONCTIONS GENERIQUES
// ********************

/**
 * Chargement d'un fichier json
 *
 * @param file {string} - Le fichier à charger
 * @returns {Promise<JSON | void>}
 */
const loadJSON = (file) => {
  return fetch(`ressources/json/${file}`)
    .then(response => response.json())
    .catch(error => console.error(error))
};


// **********
// EASTER EGG
// **********
let ks = new KonamiCode(() => {
  loadJSON('burn.json')
    .then(data => {
      data.rotate = -1;
      data.robot.ip = globalAddressRobot;
      sendData(data);
      document.querySelector('#burn').innerHTML = `<iframe src="https://giphy.com/embed/3DBeIIBdj3Lr2" width="480" height="270" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>`;
      Snackbar.show({
        text: `Burn activated`,
        pos: 'bottom-center'
      });
    })
});
