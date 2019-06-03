//importScripts('https://www.gstatic.com/firebasejs/4.8.1/firebase-app.js');
//importScripts('https://www.gstatic.com/firebasejs/4.8.1/firebase-messaging.js');

importScripts('https://www.gstatic.com/firebasejs/3.9.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/3.9.0/firebase-messaging.js');


var config = {
  apiKey: "AIzaSyA4soAMjFo8X_D7yGAVeb4C68T-otDsmuE",
  authDomain: "nimble-radio-175703.firebaseapp.com",
  databaseURL: "https://nimble-radio-175703.firebaseio.com",
  projectId: "nimble-radio-175703",
  storageBucket: "nimble-radio-175703.appspot.com",
  messagingSenderId: "64393659193"
};
firebase.initializeApp(config);

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload){
  const title = 'Notificacion de Scharff';
  const options = {
    body:""+payload.data.title+': '+payload.data.descripcion
  }
  return self.registration.showNotification(title,options);
})
//381431aaed6117b8e6af007e6d232063



// collapse_key:"do_not_collapse"
// data:action:"1"
// data:"1267"
// descripcion:"Ya llegó"
// description:"Ya llegó"
// title:"Picker"
