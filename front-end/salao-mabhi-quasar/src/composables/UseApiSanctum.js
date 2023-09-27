import { api } from 'boot/axios'

export default function UseApiSanctum (url) {
  const list = async () => {
    try {
      const response = await api.get(url)
      console.log(response.data)
      return response.data
    } catch (error) {
      throw new Error(error)
    }
  }

  const post = async (form) => {
    try {
      const response = await api.post(url, form, { headers: { 'Content-Type': 'application/json' } })
      return response.data
    } catch (error) {
      throw new Error(error)
    }
  }

  const update = async (form) => {
    try {
      const response = await api.put(`${url}/${form.id}`, form)
      return response.data
    } catch (error) {
      throw new Error(error)
    }
  }

  const remove = async (id) => {
    try {
      const response = await api.delete(`${url}/${id}`)
      return response.data
    } catch (error) {
      throw new Error(error)
    }
  }

  return {
    list,
    post,
    update,
    remove
  }
}
