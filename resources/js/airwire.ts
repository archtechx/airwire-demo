// This file is generated by Airwire
export const componentDefaults = {"report-filter":{"search":"","assignee":null,"category":null,"status":null,"reports":[]},"create-report":{"name":null,"assignee":null,"category":null},"create-user":{"name":"","email":"","password":"","password_confirmation":""}}

import Airwire from './../../vendor/archtechx/airwire/resources/js';

export default window.Airwire = new Airwire(componentDefaults)

declare global {
    interface Window {
        Airwire: Airwire
    }
}