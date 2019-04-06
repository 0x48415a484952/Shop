import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faAngleDoubleUp } from '@fortawesome/free-solid-svg-icons';

function GoToTop() {
    return(
        <div>
            <section className="bg-white border-t border-b border-nikan-brown">
                <div className="container mx-auto">
                    <div className="flex justify-center p-2">
                        <a href="#" className="flex justify-center items-center uppercase text-xs text-nikan-brown"><FontAwesomeIcon size="2x" icon={ faAngleDoubleUp }/></a>
                    </div>
                </div>
            </section>
        </div>
    );
}

export default GoToTop;