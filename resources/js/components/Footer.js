import React from 'react'
import R from './R.js'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faInstagram, faTelegram, faFacebook } from '@fortawesome/free-brands-svg-icons'
import { faAngleDoubleUp, faCheck } from '@fortawesome/free-solid-svg-icons'
function Footer() {
    return (
        <div>
            <section className="bg-white">
                <div className="container mx-auto">
                    <footer>
                        <div className="flex p-2">
                            <div className="flex w-full flex-wrap justify-between text-sm md:text-base">
                                <div className="flex w-1/2 md:w-1/4">
                                    <ul className="flex-1 my-5 text-white list-reset">
                                        <h2 className="text-nikan-brown">
                                            {R.Profile}
                                        </h2>
                                        <li className="my-2"><a className="text-grey-darker" href="#">Cart (0)</a></li>
                                        <li className="my-2"><a className="text-grey-darker" href="#">Your Account</a></li>
                                        <li className="my-2"><a className="text-grey-darker" href="#">Your Orders</a></li>
                                        <li className="my-2"><a className="text-grey-darker" href="#">Your Wish List</a></li>
                                        <li className="my-2"><a className="text-grey-darker" href="#">Tracking</a></li>
                                        <li className="my-2"><a className="text-grey-darker" href="#">Sign In</a></li>
                                        <li className="my-2"><a className="text-grey-darker" href="#">Sign Up</a></li>
                                    </ul>
                                </div>
                                <div className="flex w-1/2 my-5 md:w-1/4">
                                    <ul className="flex-1 list-reset">
                                        <h2 className="text-nikan-brown pb-2">
                                            With {R.WebsiteName}
                                        </h2>
                                        <li className="my-2"><a className="text-grey-darker" href="#">About Us</a></li>
                                        <li className="my-2"><a className="text-grey-darker" href="#">Contact Us</a></li>
                                        <li className="my-2"><a className="text-grey-darker" href="#">Jobs At {R.WebsiteName}</a></li>
                                        <li className="my-2"><a className="text-grey-darker" href="#">Terms And Conditions</a></li>
                                        <li className="my-2"><a className="text-grey-darker" href="#">Privacy Policy</a></li>
                                        <li className="my-2"><a className="text-grey-darker" href="#">Help</a></li>
                                        <li className="my-2"><a className="text-grey-darker" href="#">FAQ</a></li>
                                    </ul>
                                </div>
                                <div className="flex w-full my-5 md:w-1/4">
                                    <ul className="flex-1 list-reset">
                                        <h2 className="text-nikan-brown pb-2">
                                            Find Us
                                        </h2>
                                        <li className="my-2"><a className="text-grey-darker" href="#">Mobile: 0935 458 40 63</a></li>
                                        <li className="my-2"><a className="text-grey-darker" href="#">Telephone: 044-42 23 32 52</a></li>
                                        <li className="my-2"><a className="text-grey-darker" href="#">Address: Mahabad - Wafai St - B35</a></li>
                                        <li className="my-2"><a className="text-grey-darker" href="#">Works Day: Saturday - Friday</a></li>
                                        <li className="my-2"><a className="text-grey-darker" href="#">Support Time: 9:00 - 18:00</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </section>
        </div>
    )
}

export default Footer