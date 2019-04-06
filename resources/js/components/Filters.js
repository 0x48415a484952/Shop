import React from "react";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faFilter, faCompress } from "@fortawesome/free-solid-svg-icons"
function Filters() {
    return (
        <div className="md:hidden">
            <section>
                <div className="container mx-auto">
                    <div className="p-2 border-grey flex">
                        <button className="flex justify-around items-center text-grey-darker border border-grey-darker p-2 rounded text-sm frame-box-shadow clickStyle">
                            <a className="flex">
                                <div className="px-2">
                                    <FontAwesomeIcon className="" size="lg" icon={faFilter} />
                                </div>
                                <p>Filter Results</p>
                            </a>
                        </button>
                        <button className="flex justify-around items-center text-grey-darker border border-grey-darker p-2 rounded text-sm mx-2">
                            <div className="px-2">
                                <FontAwesomeIcon className="" size="lg" icon={faCompress} />
                            </div>
                            <p>Best Match</p>
                        </button>
                    </div>
                </div>
            </section>
        </div>
    )
}

export default Filters