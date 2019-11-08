<template>
  <v-app >

    <v-navigation-drawer v-model="drawer" :mini-variant="miniVariant" :clipped="clipped" fixed app >
<!--      <v-list>-->
<!--        <v-list-item v-for="(item, i) in items" :key="i" :to="item.to" router exact>-->
<!--          <v-list-item-action>-->
<!--            <v-icon>{{ item.icon }}</v-icon>-->
<!--          </v-list-item-action>-->
<!--          <v-list-item-content>-->
<!--            <v-list-item-title v-text="item.title" />-->
<!--          </v-list-item-content>-->
<!--        </v-list-item>-->
<!--      </v-list>-->

      <v-sheet class="pa-2 gray lighten-2" color="">
        <v-text-field v-model="search"
                      label="Buscar en opciones..."
                      dark
                      flat
                      solo-inverted
                      hide-details
                      clearable
                      clear-icon="mdi-close-circle-outline"
                      onautocomplete="off"
        ></v-text-field>

        <v-checkbox v-model="caseSensitive"
                    dark
                    hide-details
                    label="Distingue mayúsculas y minúsculas" color="white"
        ></v-checkbox>

      </v-sheet>

      <hr>
      <v-treeview :items="items"
                  :search="search"
                  :filter="filter"
                  :open.sync="openMenu"
                  activatable
                  item-key="id"
                  open-on-click
                  :active.sync="active"
                  return-object
      >
        <template v-slot:prepend="{ item }">
          <v-icon v-text="`${item.icono_l}`"></v-icon>
        </template>

      </v-treeview>


      <template v-slot:append>
        <div class="pa-2">
          <v-btn block @click.stop="open = true">
            <v-icon>mdi-logout</v-icon>
            <span  v-show="!miniVariant">SALIR</span>
          </v-btn>
        </div>
      </template>
    </v-navigation-drawer>

    <v-app-bar :clipped-left="clipped" fixed app dark color="indigo">
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" class="d-flex d-sm-none"/>
      <v-btn icon @click.stop="miniVariant = !miniVariant" class="d-none d-sm-flex">
        <v-icon>mdi-{{ `chevron-${miniVariant ? 'right' : 'left'}` }}</v-icon>
      </v-btn>
<!--      <v-btn-->
<!--        icon-->
<!--        @click.stop="clipped = !clipped"-->
<!--      >-->
<!--        <v-icon>mdi-application</v-icon>-->
<!--      </v-btn>-->
<!--      <v-btn-->
<!--        icon-->
<!--        @click.stop="fixed = !fixed"-->
<!--      >-->
<!--        <v-icon>mdi-minus</v-icon>-->
<!--      </v-btn>-->
      <v-toolbar-title v-text="title" />
      <v-spacer />



      <v-btn icon @click.stop="open = true">
        <v-icon>mdi-logout</v-icon>
      </v-btn>

      <v-btn icon @click.stop="rightDrawer = !rightDrawer">
        <v-icon>mdi-settings</v-icon>
      </v-btn>

    </v-app-bar>

    <v-content light>
      <v-container  light>
        <nuxt />

      </v-container>
    </v-content>


    <v-navigation-drawer v-model="rightDrawer" :right="right" temporary fixed>
      <v-list>
        <v-list-item >
          <v-list-item-action>
            <v-icon dark>
              mdi-palette
            </v-icon>
          </v-list-item-action>
          <v-list-item-content>
            Tema
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>


    <v-footer :fixed="fixed" app>
      <span>&copy; 2019</span>
    </v-footer>


    <v-dialog v-model="open" max-width="350" light>
      <v-card>
        <v-card-title class="headline warning" >
          <v-icon>mdi-warning</v-icon> Salir del Sistema!
        </v-card-title>

        <v-card-text>

          <div class="my-4 subtitle-1 black--text">
            Si esta seguro de salir del sistema presione el botón sí
          </div>

        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn outlined  color="gray" text @click="open = false">
            NO
          </v-btn>

          <v-btn outlined  color="error"  text @click="logout">
            SÍ
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  </v-app>
</template>

<script>

  import pkg from '../package'

export default {
    middleware: 'auth',
    created(){
      this.getMenu()
    },
    data () {
      return {
        open: false,
        clipped: true,
        drawer: true,
        fixed: true,

        openMenu: [],
        search: null,
        caseSensitive: false,
        active: [],
        items: [],

        miniVariant: false,
        right: true,
        rightDrawer: false,
        title: pkg.name.toUpperCase()
      }
    },
    methods:{
        async logout(){
            try{
                await this.$auth.logout();

                this.$router.replace("/auth/login");

                this.notifySuccess('Listo','Salio del sistema');
                this.open=false;

            }catch (e) {
                console.log(e)
            }
        },
        async getMenu(){
            try{
                const  res  = await this.$axios.$get('api/options');

                console.log(res);

                return  this.items= res.data

            }catch (e) {

                console.log(e)
            }
        }
    },
    computed:{
        filter () {
            return this.caseSensitive
                ? (item, search, textKey) => item[textKey].indexOf(search) > -1
                : undefined
        },
        selected () {

            const item = this.active[0];

            return item;
        }
    },
    watch: {
        selected (item) {
            this.consolaJs('redirect to :',item.ruta);

            this.$router.replace(item.ruta);
        },
    },
}
</script>
