<script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
<script type="module">
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-analytics.js";
  import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-messaging.js";


  // Firebase configuration
  const firebaseConfig = {
    apiKey: "{{ config('services.firebase.api_key') }}",
    authDomain: "medsnapp-platform.firebaseapp.com",
    projectId: "medsnapp-platform",
    storageBucket: "medsnapp-platform.appspot.com",
    messagingSenderId: "{{ config('services.firebase.sender_id') }}",
    appId: "{{ config('services.firebase.app_id') }}",
    measurementId: "{{ config('services.firebase.measurement_id') }}"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
  const messaging = getMessaging(app);

  onMessage(messaging, (payload) => {
    console.log('Message received. ', payload);
  });

  getToken(messaging, { vapidKey: "{{ config('services.firebase.web_platform_key') }}" })
  .then((currentToken) => {
    if (currentToken) {
      sentTokenToServer(currentToken);
    } else {
      requestPermission();

      console.log('No registration token available. Request permission to generate one.');
    }
  }).catch((err) => {
    console.log('An error occurred while retrieving token. ', err);
  });

  // Helpers function
  function sentTokenToServer(web_token) {
    const formData = new FormData();
    formData.append('user_id', {{auth()->id()}});
    formData.append('web_token', web_token);

    // api post
    axios.post('{{ config('app.main_url') }}/api/int/send-token', formData, {
      headers: { 
        'Content-Type': 'multipart/form-data',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'X-Requested-With': 'XMLHttpRequest',
      }
    }).then(
      response => console.log(response.data)
    ).catch(
      error => console.log(error)
    )
  }

  function requestPermission() {
    Notification.requestPermission().then((permission) => {
      if (permission === 'granted') {
        console.log('Notification permission granted.');
        // TODO(developer): Retrieve a registration token for use with FCM.
        // ...
      } else {
        alert('Enable permission!!!');
      }
    });
  }
</script>