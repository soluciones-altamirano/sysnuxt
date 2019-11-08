export const actions = {
  async nuxtServerInit({ commit },{ $axios }) {
    try{
      const  res  = await $axios.$get('api/options');

      const menu = res.data;

      // console.log('server init',menu);

      commit('menu/llenar',menu);

    }catch (e) {

      console.error(e)
    }
  }
}
