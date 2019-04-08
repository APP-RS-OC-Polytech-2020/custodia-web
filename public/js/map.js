// *****************
// GESTION DE LA MAP
// *****************
let capteur1 = document.querySelector('#capteur1');
let capteur1Temperature = document.querySelector('#capteur1-temperature');
let capteur1Fumee = document.querySelector('#capteur1-fumee');
let capteur1Humidite = document.querySelector('#capteur1-humidite');

let capteur2 = document.querySelector('#capteur2');
let capteur2Temperature = document.querySelector('#capteur2-temperature');
let capteur2Fumee = document.querySelector('#capteur2-fumee');
let capteur2Humidite = document.querySelector('#capteur2-humidite');

let laser = document.querySelector('#laser');
let laserText = document.querySelector('#laser-text');


const displayOnMap = (message) => {
  let macAddress = message.macAddress;
  let data = message.data;
  let backgroundColor = getBackgroundColor(data);

  switch (macAddress) {

    case "84:F3:EB:8E:68:10":
      capteur1Temperature.textContent = `${data.temperature} °C`;
      capteur1Humidite.textContent = `${data.humidity} %`;
      capteur1Fumee.textContent = data.smoke <= 600 ? `non` : `oui`;
      capteur1.style.fill = backgroundColor;
      break;

    case "BC:DD:C2:14:92:CF":
      capteur2Temperature.textContent = `${data.temperature} °C`;
      capteur2Humidite.textContent = `${data.humidity} %`;
      capteur2Fumee.textContent = data.smoke <= 600 ? `non` : `oui`;
      capteur2.style.fill = backgroundColor;
      break;
    case "DC:4F:22:46:60:89":
      break;
  }
};

const getBackgroundColor = (data) => {
  if (data.smoke >= 600) {
    return '#CC0000';
  } else if (data.temperature > 45 || data.temperature < 10 || data.humidity > 100) {
    return '#FF8800';
  }
  return '#007E33';
};

const displayAlertOnMap = () => {
  laser.style.fill = '#CC0000';
  laserText.textContent = 'on'
};

