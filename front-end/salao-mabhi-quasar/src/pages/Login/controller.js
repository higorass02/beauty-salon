import { api } from 'boot/axios'

export default function useApi (url) {
  return {
    async login () {
      try {
        const response = await api.get(url)
        return response.data
      } catch (error) {
        throw new Error(error)
      }
    }
  }
}
