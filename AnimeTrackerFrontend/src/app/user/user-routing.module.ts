import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CalendarComponent } from './pages/calendar/calendar.component';
import { ConfigComponent } from './pages/config/config.component';
import { MainComponent } from './pages/main/main.component';
import { PasswordComponent } from './pages/password/password.component';
import { ProfileComponent } from './pages/profile/profile.component';

const routes: Routes = [
  {
      path: '',
      component: MainComponent,
      children: [
        {
          path: 'calendar',
          component: CalendarComponent
        },
        {
          path: 'config',
          component: ConfigComponent
        },
        {
          path: 'password',
          component: PasswordComponent
        },
        {
          path: 'profile',
          component: ProfileComponent
        },
        {
          path: '**',
          redirectTo: 'calendar'
        }
      ]
  }
]

@NgModule({
  imports: [
    RouterModule.forChild(routes)
  ],
  exports: [
    RouterModule
  ]
})
export class UserRoutingModule { }
