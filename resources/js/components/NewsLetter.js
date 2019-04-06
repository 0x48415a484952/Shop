import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faInstagram, faTelegram, faFacebook } from '@fortawesome/free-brands-svg-icons';
import { faCheck } from '@fortawesome/free-solid-svg-icons'
function NewsLetter() {
    return(
        <div>
            <section className="bg-white">
                <div className="container mx-auto">
                    <div className="flex p-2">
                        <div className="flex w-full my-5">
                            <div className="md:flex md:justify-between flex-1 text-white items-center">
                                <div className="md:flex md:w-3/4 md:flex-col">
                                    <p className="my-2 text-nikan-brown">Get Subscribed to our NewsLetter</p>
                                    <div className="flex flex-1 border-2 border-blue-darkest rounded-full">
                                        <input className="flex-1 p-2 search-rounded-full-input" type="text" placeholder="Enter Your Email Address"/>
                                        <button className="flex justify-end items-center p-2 md:p-3 text-xs text-white search-rounded-full-button bg-nikan-orange">
                                            <FontAwesomeIcon size="2x" icon={faCheck} />
                                        </button>
                                    </div>
                                </div>
                                <div className="flex flex-1 md:w-1/4 justify-around md:mt-20 my-10 md:justify-around text-nikan-brown">
                                    <FontAwesomeIcon size="2x" icon={faInstagram}/>
                                    <FontAwesomeIcon size="2x" icon={faTelegram} />
                                    <FontAwesomeIcon size="2x" icon={faFacebook} />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    )
}

export default NewsLetter