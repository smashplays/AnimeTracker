import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { InfoComponent } from './pages/info/info.component';
import { CharacterComponent } from './pages/character/character.component';
import { PopularListComponent } from './pages/popular-list/popular-list.component';
import { MainComponent } from './pages/main/main.component';

const routes: Routes = [
  {
    path: '',
    component: MainComponent,
    children: [
      {
        path: 'popular',
        component: PopularListComponent,
      },
      {
        path: ':id',
        component: InfoComponent,
      },
      {
        path: 'character/:id',
        component: CharacterComponent,
      },
      {
        path: '**',
        redirectTo: 'popular',
      },
    ],
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class AnimeRoutingModule {}
