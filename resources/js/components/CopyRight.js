import React from 'react';
import R from './R';
function CopyRight() {
    return(
        <div>
             <section className="bg-nikan-brown">
                <div className="flex justify-center py-4 text-xs md:text-sm">
                    <p className="text-grey-light py-1">All Rights Reserved For {R.WebsiteName}</p>
                </div>
            </section>
        </div>
    )
}

export default CopyRight