import axios from 'axios'

export default axios.create({
  baseURL: 'https://throtl-dreambuild-app.com/api',
  withCredentials: true,
  headers: {
    'Content-Type': 'application/json',
    Accept: 'application/json',
    'X-Requested-With': 'XMLHttpRequest'
  }
})
