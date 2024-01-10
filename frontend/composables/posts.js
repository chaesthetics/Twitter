import axios from "axios";

const usePost = () => {
    const errors = ref({});
    const tweets = ref({});
    const postUpdateSuccess = ref("");
    const baseURL = 'http://127.0.0.1:8000/api';

    const post = async(userId, token, data) => {
        try{
            await axios.post(`${baseURL}/post`, 
                {
                    token: token,
                    user_id: userId,
                    text: data.text,
                    image: data.image,
                }
            );
        }catch(err){
            console.log(err);
        }
    }

    const getAllPost = async() => {
        try{
            const response = await axios.get(`${baseURL}/getAllPost`);
            tweets.value = response.data;
        }catch(err){
            console.log(err);
        }
    }

    const update = async(postId, data) => {
        try{
            const response = await axios.put(`${baseURL}/update/${postId}`, data);
            postUpdateSuccess.value = response.data;
        }catch(err){
            console.log(err);
        }
    }

    return {
        post,
        getAllPost,
        errors,
        tweets,
        update,
    }
}

export default usePost;