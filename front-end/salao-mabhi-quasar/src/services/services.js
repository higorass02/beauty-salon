import UseApiSanctum from 'src/composables/UseApiSanctum'

export default function serviceService () {
  const { list, post, update, remove, findOne } = UseApiSanctum('/service')

  return {
    list,
    post,
    update,
    remove,
    findOne
  }
}
