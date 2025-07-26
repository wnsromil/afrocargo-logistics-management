// public/firebase-messaging-sw.js

importScripts('https://www.gstatic.com/firebasejs/9.6.10/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.6.10/firebase-messaging-compat.js');

firebase.initializeApp({
    apiKey: "AIzaSyBRDTSO2avRn6zVgQx-JA3kFwfUzYzslQ8",
    authDomain: "afrouser-31ae2.firebaseapp.com",
    projectId: "afrouser-31ae2",
    storageBucket: "afrouser-31ae2.firebasestorage.app",
    messagingSenderId: "566157794214",
    appId: "1:566157794214:web:fe1c5fc6169a07e9b44d67",
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function (payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: '/logo.png', // optional
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
