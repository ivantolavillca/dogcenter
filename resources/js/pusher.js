import Pusher from 'pusher-js';

// Enable pusher logging - remove this line in production
Pusher.logToConsole = true;

const pusher = new Pusher(PUSHER_APP_KEY, {
    cluster: PUSHER_APP_CLUSTER,
    encrypted: true
  });

export default pusher;