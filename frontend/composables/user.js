import axios from "axios";
import { ref } from 'vue';
import { useRouter } from "vue-router";
 
const router = useRouter();

const useUser = () => {
    const errors = ref({});
    const userData = ref({});
    const errorsMessage = ref({});
    const successMessage = ref('');
    const userTweets = ref({});
    const thisUser = ref({});

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
            localStorage.setItem("signIn", "Logged in successfully");
            navigateTo({path : "/home"});
        }catch(err){
            errors.value = err.response?.data.data;
            errorsMessage.value = err.response?.data.message;
        }
    } 
    
    const updateProfile = async(userId) => {
        try{
            const response1 = await axios.put(`${baseURL}/editProfile/${userId}`, userData.value);
            const response = await updateUserData(userId);
            userData.value = response.data;
            localStorage.setItem("updateProfileSuccess", JSON.stringify(response1.data.message));
            localStorage.setItem("user", JSON.stringify(response.data));
        }catch(err){
            console.log(err);
        }
    }

    const updateUserData = async(userId) => {
        const response = await axios.get(`${baseURL}/getUserData/${userId}`);
        return response;
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

    const fetchUserTweets = async(userId) =>{
        try{
            const response = await axios.get(`${baseURL}/getUserData/${userId}`);
            userTweets.value = response.data.posts;
        }catch(err){
            console.log(err);
        }
    }
    
    const getThisUserData = async(username) => {
        try{
            const response = await axios.get(`${baseURL}/getThisUserData/${username}`);
            thisUser.value = response.data;
            console.log("This User:", thisUser.value);
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
        updateProfile,
        fetchUserTweets,
        userTweets,
        errors,     
        errorsMessage, 
        successMessage,
        getThisUserData,
        thisUser,
    }
}

export default useUser;