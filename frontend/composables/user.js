import axios from "axios";
import { useRouter } from "vue-router";

const useUser = () => {
    const errors = ref({});
    const userData = ref({});

    const baseURL = 'http://127.0.0.1:8000/api';
    
    const signUp = async(data) => {
        try{
            await axios.post(`${baseURL}/signup`, data);
        }catch(err){
            errors.value = err.response.data.data;
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
    }
}

export default useUser;