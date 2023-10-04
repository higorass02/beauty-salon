import UseApiSanctum from 'src/composables/UseApiSanctum'

export default function customerService () {
  const { list, post, update, remove, findOne } = UseApiSanctum('/customer')

  return {
    list,
    post,
    update,
    remove,
    findOne
  }
}
