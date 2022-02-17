import AllUser from './components/AllUser.vue';
import EditUser from './components/EditUser.vue';
  
export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllUser
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditUser
    }
];