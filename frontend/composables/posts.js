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
                },{
                    headers: {
                        Authorization: `Bearer ${token}`
                    },
                }
            );
        }catch(err){
            console.log(err);
        }
    }

    const getAllPost = async () => {
        const token = localStorage.getItem("token");
        try {
            const response = await axios.get(`${baseURL}/getAllPost`, {
                headers: {
                      Authorization: `Bearer ${token}`
                }
            });
            tweets.value = response.data;
        } catch (err) {
            console.log(err);
        }
    }

    // const getAllPost = async (token) => {
    //     try {
    //         const response = await axios.get(`${baseURL}/getAllPost`, {
    //             headers: {
    //                 Authorization: `Bearer ${token}`
    //             }
    //         });
    //         tweets.value = response.data;
    //     } catch (err) {
    //         console.log(err);
    //     }
    // }


    const update = async(postId, data) => {
        const token = localStorage.getItem("token");
        try{
            const response = await axios.put(`${baseURL}/update/${postId}`, data, {
                headers:{
                    Authorization: `Bearer ${token}`,
                }
            });
            postUpdateSuccess.value = response.data;
            localStorage.setItem("updatePostSuccess", JSON.stringify(postUpdateSuccess.value.message));
        }catch(err){
            console.log(err);
        }
    }

    const deletepost = async(postId) => {
        const token = localStorage.getItem("token");
        try{
            const response = await axios.delete(`${baseURL}/deletePost/${postId}`,{
                headers:{
                    Authorization: `Bearer ${token}`,
                }
            });
            localStorage.setItem("deleteSuccess", JSON.stringify(response.data.message));
        }catch(err){
            console.log(err);
        }
    }

    const likepost = async(userId, postId) => {
        const token = localStorage.getItem("token");
        try{
            const response = await axios.post(`${baseURL}/like`, { 
                "user_id" : userId,
                "post_id" : postId
            },{
                headers: {
                    Authorization: `$Bearer ${token}`
                }
            });
        }catch(err){
            console.log(err);
        }finally{    
            getAllPost();
        }
    }

    const unlikepost = async(userId, postId) => {
        const token = localStorage.getItem("token");
        try{
            const response = await axios.post(`${baseURL}/unlike`, {
                "user_id" : userId,
                "post_id" : postId
            },{
                headers: {
                    Authorization: `Bearer ${token}`
                }
            });
        }catch(err){
            console.log(err);
        }finally{    
            getAllPost();
        }
    }

    return {
        post,
        getAllPost,
        errors,
        tweets,
        update,
        deletepost,
        likepost,
        unlikepost,
    }
}

export default usePost;