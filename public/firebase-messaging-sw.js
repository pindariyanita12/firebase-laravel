// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyBKWx6Dn7ThxP4j4WxQKQ7uX1DFmCtCIX8",
    authDomain: "laravel-firebase-demo-9165b.firebaseapp.com",
    databaseURL: "https://laravel-firebase-demo-9165b-default-rtdb.firebaseio.com",
    projectId: "laravel-firebase-demo-9165b",
    storageBucket: "laravel-firebase-demo-9165b.appspot.com",
    messagingSenderId: "950715952082",
    appId: "1:950715952082:web:3758168f98f42c0d07f60b",
    measurementId: "G-DX43MCD7JL"
});


// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);

    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };

    return self.registration.showNotification(
        title,
        options,
    );
});
