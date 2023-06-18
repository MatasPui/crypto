import './bootstrap';

import { createApp } from 'vue';
import TableContent from './components/TableContent.vue';
const app = createApp({
    components:{
        TableContent,
    }
});
app.mount("#app");