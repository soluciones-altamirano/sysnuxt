export const state = () => ({
  options: []
})

export const mutations = {
    llenar(state,options){
      state.options = options
    }
}

export const actions = {
  async load({commit}){
    try{
      const  res  = await this.$axios.$get('api/options');

      const menu = res.data;

      commit('llenar',menu);

    }catch (e) {

      console.error(e)
    }
  }
}
