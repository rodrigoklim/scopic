import axios from 'axios'

const apiClient = axios.create({
  baseURL: 'http://localhost/scopic_test/backend/public/',
  withCredentials:true
  
})

export default apiClient