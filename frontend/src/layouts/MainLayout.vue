<template>
  <q-layout view="hHh lpR fFf">
    <q-header elevated>
      <q-toolbar>
        <q-card class="q-my-sm" style="max-width: 135px;">
          <div class="row justify-center items-center q-mx-sm">
            <q-btn to="/">
              <!-- <q-img src="~/assets/img/vemom_logo.svg" class="q-my-sm" width="120px" /> -->
            </q-btn>
          </div>
        </q-card>
        <q-space />
        <q-tabs
            align="right"
            indicator-color="white"
            style="margin-top: 0.45em"
            no-caps
            class="poppins text-bold"
          >
            <q-btn-dropdown
              auto-close
              stretch
              flat
              :label="user"
              no-caps
              style="width: 175px"
            >
              <q-list>
                <q-item
                  clickable
                  @click='logout'
                >
                  <q-item-section>
                    <q-icon
                      name="exit_to_app"
                      color="primary"
                      size="sm"
                    />
                  </q-item-section>
                  <q-item-section>
                    Log-out
                  </q-item-section>
                </q-item>
              </q-list>
            </q-btn-dropdown>
          </q-tabs>

      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      elevated
      show-if-above
      class="bg-grey-2"
      :mini="miniState"
        @mouseover="miniState = false"
        @mouseout="miniState = true"
    >
      <q-list class="poppins text-bold">
        <q-item-label
          header
          class="text-grey-8"
        >
          Menu
        </q-item-label>
        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
        />
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
import EssentialLink from 'components/EssentialLink'
import apiClient from 'src/services/api'

export default {
  name: 'MainLayout',
  components: {
    EssentialLink
  },
  data () {
    return {
      leftDrawerOpen: false,
      essentialLinks: [
        {
          title: 'Usuários',
          caption: 'Criar / Editar / Excluir',
          icon: 'person',
          link: '/usuarios'
        },
        {
          title: 'Matéria Prima',
          caption: 'Criar / Editar / Excluir',
          icon: 'cable',
          link: '/produtos'
        }
      ],
      user: '',
      miniState: true
    }
  },
  mounted () {
    this.user = this.$vuex.state.name
  },
  methods: {
    logout () {
      const url = 'api/logout'
      apiClient.post(url).then(response => {
        
        this.$router.push('/login')
      })
    }
  }
}
</script>