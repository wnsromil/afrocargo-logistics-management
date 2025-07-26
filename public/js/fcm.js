// public/js/fcm.js

document.addEventListener('DOMContentLoaded', function () {
    const firebaseConfig = {
        apiKey: "AIzaSyBRDTSO2avRn6zVgQx-JA3kFwfUzYzslQ8",
        authDomain: "afrouser-31ae2.firebaseapp.com",
        projectId: "afrouser-31ae2",
        storageBucket: "afrouser-31ae2.firebasestorage.app",
        messagingSenderId: "566157794214",
        appId: "1:566157794214:web:fe1c5fc6169a07e9b44d67",
        measurementId: "G-85ZJM61P7N"
    };

    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/firebase-messaging-sw.js')
            .then(function (registration) {
                messaging.useServiceWorker(registration);
                console.log("Service Worker Registered");

                messaging.requestPermission()
                    .then(() => {
                        console.log("Notification permission granted.");
                        return messaging.getToken({
                            vapidKey: "BH54p9woB3QLrftD7FTSx160UhEZcF2k2Cz3eekSr9z7rYYLD49GHelyzajWC4P2kDrK2dpZnC6J0U17yRQJdBw"
                        });
                    })
                    .then((currentToken) => {
                        if (currentToken) {
                            console.log("Firebase Token:", currentToken);

                            // Optional: Send token to server
                            // fetch('/save-firebase-token', {
                            //     method: 'POST',
                            //     headers: {
                            //         'Content-Type': 'application/json',
                            //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            //     },
                            //     body: JSON.stringify({ token: currentToken })
                            // });

                        } else {
                            console.log("No registration token available.");
                        }
                    })
                    .catch((err) => {
                        console.error("Token error:", err);
                    });
            })
            .catch((err) => {
                console.error("Service Worker error:", err);
            });

        // Foreground Message
        messaging.onMessage(function (payload) {
            console.log("Foreground Message:", payload);

            const { title, body } = payload.notification;
            const notification = new Notification(title, {
                body: body,
                icon: '/logo.png',
            });
        });
    }
});
