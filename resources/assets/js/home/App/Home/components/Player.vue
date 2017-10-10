<template>
    <section class="player">
        <div class="container center-align">
            <div class="row">
                <div class="player-controlls col m8 offset-m5">
                    <div class="col m2">
                        <a class="play-btn btn-floating btn-large waves-effect waves-light purple-radio" @click="tooglePlay()"><i class="material-icons">{{ !isPlaying? 'play_arrow': 'pause' }}</i></a>
                    </div>
                    <div class="col m2">
                        <p class="range-field valign-wrapper">
                            <i class="material-icons">{{ (volumeLevel != 0)? 'volume_up': 'volume_off' }}</i> <input type="range" min="0" max="10" v-model="volumeLevel"/>
                        </p>
                    </div>
                        
                </div>
            </div>
        </div>
        <audio controls name="media" id="media-player" style="display:none">
            <source src="http://servidor30.brlogic.com:8868/live" type="audio/mpeg">
        </audio>
    </section>
</template>

<script>
export default {
    data() {
        return {
            isPlaying: false,
            volumeLevel: 10
        }
    },

    created() {
        
    },

    watch: {
        volumeLevel: function(val, oldVal) {
            let mediaPlayer = document.getElementById("media-player")
            var newVal = val/10
            
            mediaPlayer.volume = newVal
        }
    },

    methods: {
        tooglePlay() {
            let mediaPlayer = document.getElementById("media-player")
            console.log(mediaPlayer.volume)

            if(!this.isPlaying) {
                mediaPlayer.play()
                this.isPlaying = true
            }else{
                mediaPlayer.pause()
                this.isPlaying = false
            }
        }
    }
}
</script>

<style>
.player {
    background-color: rgba(218, 192, 45, 0.9);
    font-family: Merriweather Sans,sans-serif;
    position: fixed;
    z-index: 100;
    height: 50px;
    width: 100%;
    bottom: 0;
    left: 0;
}

.play-btn {
    bottom:15px;
}

.range-field {
    position: relative;
    bottom: 5px;
}

.range-field .thumb {
    background-color: #322C53 !important;
}

input[type=range]::-webkit-slider-thumb {
  background: #322C53 !important;
}
</style>
