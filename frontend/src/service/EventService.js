import axios from 'axios';

inter

export default {
    getEvents() {
        return axios.get('/backend/get_events.php');
    }
}