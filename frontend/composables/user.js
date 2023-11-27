import axios from "axios";

const useUser = () => {
    const errors = ref({});

    const baseURL = 'http://127.0.0.1:8000/api';

    const signUp = async(data) => {
        try{
            await axios.post(`${baseURL}/signup`, data);
        }catch(err){
            errors.value = err.response.data;
        }
    }

    const logIn = async(data) => {
        try{
            await axios.post(`${baseURL}/login`, data);
        }catch(err){
            err.value = err.response.data;
        }
    } 

    return{
        signUp,
        logIn,
        errors,
        
    }
}

export default useUser;