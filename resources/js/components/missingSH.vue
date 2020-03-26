<template>
    <div>
        <h3>Missing</h3>
        <div v-for="mis in missing">
            <div>{{mis}}</div>
        </div>
    </div>

</template>

<script>
export default{
    name:"missingSH",
    props: ['missing']
  
}
</script>