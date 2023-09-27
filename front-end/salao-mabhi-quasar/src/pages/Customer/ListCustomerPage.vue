<template>
  <q-page :style-fn="myTweak" padding>
    <q-table title="Clientes" :rows="posts" :columns="columns" row-key="name">

      <template v-slot:top>
        <span class="text-h5">Clientes</span>
        <q-space />
        <q-btn color="primary" label="Novo" :to="{ name: 'formCustomer' }" />
      </template>

      <template v-slot:body-cell-actions="props">
        <q-td :props="props">
          <q-btn
            push
            color="negative"
            dense
            size="sm"
            icon="delete"
            @click="handleDeleteCustomer(props.row.id)"
          />
        </q-td>
      </template>
    </q-table>
  </q-page>
</template>

<script>
import { ref, onMounted } from 'vue'
import customerService from 'src/services/customers.js'
import { useQuasar } from 'quasar'

export default {
  name: 'CustomerPage',
  setup () {
    const $q = useQuasar()
    const posts = ref([])
    const { list, remove } = customerService()

    const columns = [
      {
        name: 'id',
        field: 'id',
        label: 'ID',
        sortable: true,
        align: 'left'
      },
      {
        name: 'name',
        field: 'name',
        label: 'Nome',
        sortable: true,
        align: 'left'
      },
      {
        name: 'phone',
        field: 'phone',
        label: 'Telefone',
        sortable: true,
        align: 'left'
      },
      {
        name: 'actions',
        field: 'actions',
        label: 'Ações',
        align: 'center'
      }
    ]

    onMounted(() => {
      getCustomers()
    })

    const getCustomers = async () => {
      try {
        posts.value = await list()
      } catch (error) {
        console.log(error)
      }
    }

    const handleDeleteCustomer = async (id) => {
      try {
        $q.dialog({
          title: 'Deleção ?',
          message: 'Deseja realmente deletar este Cliente ?',
          cancel: true,
          persistent: true
        }).onOk(async () => {
          await remove(id)
          getCustomers()
          $q.notify({
            color: 'green-3',
            textColor: 'white',
            icon: 'success',
            message: 'Cliente deletado com sucesso!'
          })
        })
      } catch (error) {
        $q.notify({
          color: 'red-5',
          textColor: 'white',
          icon: 'error',
          message: 'Erro ao deletar o cliente'
        })
      }
    }

    return {
      posts,
      columns,
      handleDeleteCustomer
    }
  }
}
</script>
