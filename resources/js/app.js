import './bootstrap';

if (window.Echo) {
  window.Echo.channel('futbol-femeni')
    .listen('.PartitActualitzat', (e) => {
      console.log('PartitActualitzat rebut:', e);
      window.dispatchEvent(new CustomEvent('classificacio-delta', { detail: e.delta }));
    });
} else {
  console.warn('Echo no està inicialitzat (window.Echo no existeix).');
}