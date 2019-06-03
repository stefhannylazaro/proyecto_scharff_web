<template>
  <div class="c-list-wrapper">
    <span>{{nameTitle}}</span>
    <div class="c-items-list" :class="{zIndexTwo: firstItem}" @click="showItems = !showItems">
      <span class="c-item">{{selected}}</span>
      <div class="list-item" v-if="showItems">
        <ul class="">
          <li v-for="el in listData" :key="el.name" @click="setValue(el)">{{el.name}}</li>
        </ul>
      </div>
    </div>


  </div>
</template>

<script>
export default {
  props: ['nameTitle','listData', 'selected', 'firstItem'],
  data () {
    return {
      showItems: false
    }
  },
  methods: {
    setValue: function (item) {
      // this.showItems = false
      // console.log(this.showItems)
      this.$emit('selectValue', item )
    }
  }

}
</script>

<style lang="scss">
@import "../../scss/vars.scss";
.zIndexTwo{
  z-index: 10!important;
}
.c-items-list{
  width: 13rem;
  z-index: 1;
  // width: 100%;
  background: #f2f2f2;
  position: relative;
  cursor: pointer;
  border-radius: .3rem;
}
.c-item{
  width: 100%;
  // background: orange;

}
.c-list-wrapper{
  display: flex;
  width: 100%;
  // z-index: 3;
  justify-content: space-between;
  align-items: center;
}
.list-item{
  background: #f2f2f2;
  width: 100%;
  position: absolute;
  ul{
    list-style: none;
    li{
      border-bottom: solid .1rem #e2e2e2;
      padding: .5rem;
      &:hover{
        background: #dadad9;
      }
    }
  }
}

</style>
