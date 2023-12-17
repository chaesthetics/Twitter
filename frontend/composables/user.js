import axios from "axios";
import { ref } from 'vue';
import { useRouter } from "vue-router";
 
const router = useRouter();

const useUser = () => {
    const errors = ref({});
    const userData = ref({});
    const errorsMessage = ref({});
    const successMessage = ref('');
    
    const baseURL = 'http://127.0.0.1:8000/api';
    
    const signUp = async(data) => {
        try{
            const response = await axios.post(`${baseURL}/signup`, data);
            localStorage.setItem("signUp", response.data.message);
            navigateTo({path : "/"});
        }catch(err){
            errors.value = err.response?.data.data;
            errorsMessage.value = err.response?.data;
        }
    }

    const logIn = async(data) => {
        try{
            const response = await axios.post(`${baseURL}/login`, data);
            localStorage.setItem("token", response.data.data.token);
            localStorage.setItem("user", JSON.stringify(response.data.data.user));
            errors.value = null
        }catch(err){
            errors.value = err.response.data.data;
        }
    } 
    
    const logOut = async() => {
        try{
            localStorage.removeItem("token");
            localStorage.removeItem("user");
            navigateTo("/");
        }catch(err){
            console.log(err);
        }
    }

    const getUser = async() => {
        try{
            userData.value = JSON.parse(localStorage.getItem("user"));
        }catch(err){
            console.log(err);
        }
    }
    
    return{
        signUp,
        logIn,
        logOut,
        getUser,
        userData,
        errors,     
        errorsMessage, 
        successMessage,
    }
}

export default useUser;