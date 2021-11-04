import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '669db87d95cd5b9c979c',
    cluster: 'us2',
    forceTLS: true
});

export default async ({ Vue }) => {
}