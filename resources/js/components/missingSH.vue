<template>
    <div>
        <h4>Missing</h4>
        <li v-for="mis in missing" v-bind:key="mis" class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;"><span style="font-family: monospace;"><div v-html="mis"> </div></span></li>
    </div>
</template>

<script>
export default{
    name:"missingSH",
    props: ['missing']
  
}
</script>