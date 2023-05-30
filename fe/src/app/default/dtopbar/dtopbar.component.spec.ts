import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DtopbarComponent } from './dtopbar.component';

describe('DtopbarComponent', () => {
  let component: DtopbarComponent;
  let fixture: ComponentFixture<DtopbarComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [DtopbarComponent]
    });
    fixture = TestBed.createComponent(DtopbarComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
