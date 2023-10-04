import UseApiSanctum from 'src/composables/UseApiSanctum'

export default function employeeService () {
  const { list, post, update, remove, findOne } = UseApiSanctum('/employee')

  return {
    list,
    post,
    update,
    remove,
    findOne
  }
}
