// *****************
// GESTION DE LA MAP
// *****************
let map = document.querySelector('#map').contentDocument.children[0].children;
let firstSensor = map.Capteur1.firstElementChild;
let secondSensor = map.Capteur2.firstElementChild;
let laser = map.Laser.firstElementChild;
let textFirstSensor = map[16].firstElementChild;
let textSecondSensor = map[17].firstElementChild;
let textLaser = map[18].firstElementChild;

const displayOnMap = (message) => {
    let macAddress = message.macAddress;
    let data = message.data;
    let backgroundColor = getBackgroundColor(data);

    switch (macAddress) {
        case "1A":
            textFirstSensor.children[1].textContent = `${data.temperature} °C`;
            textFirstSensor.children[3].textContent = `${data.humidity} %`;
            textFirstSensor.children[5].textContent = data.smoke === 0 ? `non` : `oui`;
            firstSensor.style.fill = backgroundColor;
            break;
        case "1B":
            textSecondSensor.children[1].textContent = `${data.temperature} °C`;
            textSecondSensor.children[3].textContent = `${data.humidity} %`;
            textSecondSensor.children[5].textContent = data.smoke === 0 ? `non` : `oui`;
            secondSensor.style.fill = backgroundColor;
            break;
    }
};

const getBackgroundColor = (data) => {
  if (data.smoke > 0) {
      return '#CC0000';
  }
  else if (data.temperature > 45 || data.temperature < 10 || data.humidity > 20) {
      return '#FF8800';
  }
  return '#007E33';
};

const displayAlertOnMap = () => {
  laser.style.fill = '#CC0000';
  textLaser.children[1].textContent = 'on'
};
