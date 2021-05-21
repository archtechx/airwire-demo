
declare global {
    type Report = { id: number, name: string, assignee_id: string, category: string, status: string, created_at: string, updated_at: string, assignee: User };

type User = { id: number, name: string, email: string, email_verified_at: string, created_at: string, updated_at: string, reports: Report };


}

import './../../vendor/archtechx/airwire/resources/js/airwired'

declare module 'airwire' {
    export type TypeMap = {
    'report-filter': ReportFilter
    'create-report': CreateReport
    'create-user': CreateUser
}
    interface ReportFilter {
    search: string;
    assignee: number;
    category: number;
    status: string;
    reports: Report[];
    changeStatus(report: Report|string|number): AirwirePromise<string>;
    mount(): AirwirePromise<any>;
    errors: {
        [key in keyof WiredProperties<ReportFilter>]: string[];
    }

    loading: boolean;

    watch(responses: (response: ComponentResponse<ReportFilter>) => void, errors?: (error: AirwireException) => void): void;
    defer(callback: CallableFunction): void;
    refresh(): ComponentResponse<ReportFilter>;
    remount(...args: any): ComponentResponse<ReportFilter>;

    readonly: ReportFilter;

    deferred: ReportFilter;
    $component: ReportFilter;
}

interface CreateReport {
    name: string;
    assignee: number;
    category: number;
    create(): AirwirePromise<Report>;
    mount(): AirwirePromise<any>;
    errors: {
        [key in keyof WiredProperties<CreateReport>]: string[];
    }

    loading: boolean;

    watch(responses: (response: ComponentResponse<CreateReport>) => void, errors?: (error: AirwireException) => void): void;
    defer(callback: CallableFunction): void;
    refresh(): ComponentResponse<CreateReport>;
    remount(...args: any): ComponentResponse<CreateReport>;

    readonly: CreateReport;

    deferred: CreateReport;
    $component: CreateReport;
}

interface CreateUser {
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
    create(): AirwirePromise<User>;
    errors: {
        [key in keyof WiredProperties<CreateUser>]: string[];
    }

    loading: boolean;

    watch(responses: (response: ComponentResponse<CreateUser>) => void, errors?: (error: AirwireException) => void): void;
    defer(callback: CallableFunction): void;
    refresh(): ComponentResponse<CreateUser>;
    remount(...args: any): ComponentResponse<CreateUser>;

    readonly: CreateUser;

    deferred: CreateUser;
    $component: CreateUser;
}


}