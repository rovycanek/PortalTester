<template>
    <div>
        <h4>Present</h4>
        <div v-for="value in present" v-bind:key="value">
            <div v-if="value.length>2">
                <div><li class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;"><span style="color:lime">{{value}}</span></li></div>
            </div>
        </div>
    </div>

</template>

<script>
export default{
    name:"missingSH",
    props: ['present']
  
}
</script>












