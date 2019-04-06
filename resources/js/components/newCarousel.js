import React from 'react';
import OwlCarousel from 'react-owl-carousel2';


const options = {
    items: 1,
    nav: true,
    rewind: true,
    autoplay: true
};
 
const events = {
    onDragged: function(event) {
        
    },
    onChanged: function(event) {

    }
};

function newCarousel() {
    return(
        <div>
            <OwlCarousel ref="car" options={options} events={events} >
                <div><img src="/img/fullimage1.jpg" alt="The Last of us"/></div>
                <div><img src="/img/fullimage2.jpg" alt="GTA V"/></div>
                <div><img src="/img/fullimage3.jpg" alt="Mirror Edge"/></div>
            </OwlCarousel>
        </div>
    )
}

export default newCarousel