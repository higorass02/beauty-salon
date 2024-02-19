import UseApiSanctum from 'src/composables/UseApiSanctum'

export default function appointmentsService () {
  const { list, post, update, remove, findOne } = UseApiSanctum('/appointment')

  return {
    list,
    post,
    update,
    remove,
    findOne
  }
}
