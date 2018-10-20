import { NgModule } from '@angular/core';
import { RouterModule, Routes, Router } from '@angular/router';


const appRoutes: Routes = [
    {
        path: 'login'
    }


];

@NgModule({
    imports: [

        RouterModule.forRoot(
            appRoutes,
            { enableTracing: true, useHash: true }

        )
    ],
    exports: [
        RouterModule
    ],

})

export class AppRoutingModule { }
