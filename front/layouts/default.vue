<template>
  <v-app light>

    <v-navigation-drawer v-model="drawer" :mini-variant="miniVariant" :clipped="clipped" fixed app >



      <sidebar></sidebar>


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

      <v-toolbar-title v-text="title" />

      <v-spacer /><!-- espacio para mover los sig iconos a la derecha -->

      <v-btn icon @click.stop="open = true">
        <v-icon>mdi-logout</v-icon>
      </v-btn>

      <v-btn icon @click.stop="rightDrawer = !rightDrawer">
        <v-icon>mdi-settings</v-icon>
      </v-btn>

    </v-app-bar>

    <v-content>
      <v-container class="px-5 py-5">
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


    <footer></footer>


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
  import Sidebar from "../components/Sidebar/Sidebar";
  import Footer from "../components/Footer/Footer";


export default {
    components: {Footer, Sidebar},
    middleware: 'auth',
    created(){
    },
    data () {
      return {
        open: false,
        clipped: true,
        drawer: true,
        fixed: true,


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
        }
    }
}
</script>
