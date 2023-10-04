<template>
  <q-page padding>
    <div v-if="!load">
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
              dense
              color="primary"
              size="md"
              icon="edit"
              @click="handleEditCustomer(props.row.id)"
            />
            <q-btn
              push
              dense
              color="negative"
              class="q-ml-sm"
              size="md"
              icon="delete"
              @click="handleDeleteCustomer(props.row.id)"
            />
          </q-td>
        </template>
      </q-table>
    </div>
    <div v-if="load" align="center">
      <q-circular-progress
        indeterminate
        size="50px"
        :thickness="0.22"
        rounded
        color="primary"
        track-color="grey-3"
        class="q-ma-md"
      />
      <div class="text-h6">Carregando Clientes...</div>
    </div>
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
    const load = ref(true)
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
        load.value = false
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
          $q.loading.show({
            message: 'Deletando Cliente....'
          })
          await remove(id)
          $q.loading.hide()
          load.value = true
          await getCustomers()
          load.value = false
          $q.notify({
            color: 'green-3',
            textColor: 'white',
            icon: 'check',
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

    const handleEditCustomer = async (id) => {
      window.location.href = '/customer/' + id + '/edit'
    }

    return {
      load,
      posts,
      columns,
      handleDeleteCustomer,
      handleEditCustomer
    }
  }
}
</script>
