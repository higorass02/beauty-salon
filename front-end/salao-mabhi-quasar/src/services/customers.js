import UseApiSanctum from 'src/composables/UseApiSanctum'

export default function customerService () {
  const { list, post, update, remove } = UseApiSanctum('/customer')

  return {
    list,
    post,
    update,
    remove
  }
}
