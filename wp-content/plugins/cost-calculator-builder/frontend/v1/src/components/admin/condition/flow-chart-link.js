export default {
    props: {
        /** start point position [x, y] **/
        end: {
            type: Array,
            default() {
                return [0, 0]
            }
        },
        id: {
            type: Number,
        },
        link: {
            type: Object
        },
        modal:{
            type: Boolean
        },
        start: {
            type: Array,
            default() {
                return [0, 0]
            }
        },
        /** end point position [x, y] **/

    },
    data() {
        return {
            show: {
                delete: false,
            },
            responsive: {
                1920: { // done √
                    ex: 1150,
                    cx: 1325,
                    x2: 1142,
                    x1: 1325,
                },
                1600: {
                    ex: 830,
                    cx: 1000,
                    x2: 829,
                    x1: 1000,
                },
                1440: {
                    ex: 710,
                    cx: 880,
                    x2: 717,
                    x1: 880,
                },
                1220: {
                    ex: 500,
                    cx: 650,
                    x2: 500,
                    x1: 650,
                },
            }
        }
    },
    methods: {
        caculateCenterPoint() {
            // caculate arrow position: the center point between start and end
            let ex = this.end[0];
            let cx = this.start[0];
            let ey = this.end[1];
            let cy = this.start[1];

            let start0 = cx;
            let start1 = cy;

            const dx = (ex  - cx ) / 2;
            const dy = (ey  - cy ) / 2;

            const y = start0 + dx;
            const x = ( start1 + dy ) > 39 ? ( start1 + dy ) > 467.5 ? 467.5 : start1 + dy : 39;

            return [y, x];
        },
        editLink(e) {
            this.$emit('editLink', e, this.link.id, this.caculateCenterPoint());
        },
    },
    computed: {
        pathStyle() {
            return {
                stroke: '#bdc9ca',
                strokeWidth: 2.73205,
                fill: 'none',
            };
        },
        arrowTransform() {
            const [arrowX, arrowY] = this.caculateCenterPoint();
            return `translate(${arrowX}, ${arrowY})`;
        },
        arrowTransformText() {
            const [arrowX, arrowY] = this.caculateCenterPoint();
            const platformType     = window.navigator.platform
            const platform         = {x: platformType === 'MacIntel' ? 0 : 3.5, y: platformType === 'MacIntel' ? 0 : 0.5}
            return `translate(${arrowX - platform.x}, ${arrowY + platform.y})`;
        },
        dAttr() {
            let cx = this.start[0];
            let ex = this.end[0];
            let ey = this.end[1];
            let cy = this.start[1];

            let x1 = cx, y1 = cy, x2 = ex, y2 = ey;

            this.$emit('update');
            return `M ${cx}, ${cy} C ${x1}, ${y1}, ${x2}, ${y2}, ${ex}, ${ey}`;
        },
        circleAttr(){
            return  {
                fontFamily: 'sans-serif',
                fontSize: '27px',
                fill: '#00b163'
            };
        },

        /** arrow identificator for link line**/
        markerUrl() {
            return 'url(#' + ['arrow', this.link.id].join('_') + ')';
        },

        /**
         * Arrow angle based on link line
         * @returns {number}
         */
        arrowAngle() {
            var dy    = this.end[1] - this.start[1];
            var dx    = this.end[0] - this.start[0];
            var theta = Math.atan2(dy, dx); // range (-PI, PI]
            theta *= 180 / Math.PI; // rads to degs, range (-180, 180]
            if ( theta < 0 ) {
                theta = 360 + theta; // range [0, 360)
            }
            return theta;
        },
    },
    template: `
      <template>
        <g fill="none" :data-link="link.id">
          <defs>
            <marker :id="['arrow', link.id].join('_')" markerWidth="7" markerHeight="6" refX="6.5" refY="3" :orient="arrowAngle" markerUnits="strokeWidth">
              <path d="M0,0 L0,6 L7,3 z" fill="rgb(189, 201, 202)" />
            </marker>
          </defs>
          <path stroke-dasharray="5,5" :d="dAttr" :style="pathStyle" :marker-end="markerUrl"></path>
          <circle @click="editLink" cx="0" cy="0" r="19.5" fill="#fff" style="stroke-width:1px; stroke:#bdc9ca;" :transform="arrowTransform"/>
          <text class="no-draggable" @click="editLink" :style="circleAttr" :transform="arrowTransformText" id="chk" x=-10 y=10>&#9998;</text>
        </g>
      </template>
    `,
}