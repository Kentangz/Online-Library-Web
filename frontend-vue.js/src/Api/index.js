import axios from 'axios';

// Set up the base URL for the API
const api = axios.create({
  baseURL: 'http://localhost:8000/api',  // Change this to your API's base URL
  
})

export default api 