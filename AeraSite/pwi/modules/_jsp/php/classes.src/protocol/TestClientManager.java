/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.TimerTask;
/*    */ import com.goldhuman.IO.Protocol.Manager;
/*    */ import com.goldhuman.IO.Protocol.ReconnectTask;
/*    */ import com.goldhuman.IO.Protocol.Session;
/*    */ import com.goldhuman.IO.Protocol.State;
/*    */ import java.io.PrintStream;
/*    */ 
/*    */ public final class TestClientManager extends Manager
/*    */ {
/*    */   public Session s;
/* 27 */   private boolean conn_state = false;
/*    */ 
/* 16 */   private Object locker_state = new Object();
/*    */   private static final int BACKOFF_INIT = 2;
/*    */   private static final int BACKOFF_DEADLINE = 8;
/* 27 */   private int backoff = 2;
/*    */ 
/*    */   void Reconnect()
/*    */   {
/* 22 */     TimerTask.AddTimerTask(new ReconnectTask(this, 1), this.backoff);
/* 23 */     this.backoff *= 2;
/* 24 */     if (this.backoff > 8) this.backoff = 8; 
/*    */   }
/*    */ 
/*    */   public boolean GetConnectState()
/*    */   {
/* 28 */     return this.conn_state;
/*    */   }
/*    */ 
/*    */   protected synchronized void OnAddSession(Session session)
/*    */   {
/* 39 */     this.s = session;
/*    */ 
/* 42 */     System.out.println("OnAddSession " + session);
/* 43 */     notify();
/*    */   }
/*    */ 
/*    */   protected void OnDelSession(Session session)
/*    */   {
/* 52 */     System.out.println("OnDelSession " + session);
/* 53 */     this.s = null;
/*    */   }
/*    */ 
/*    */   protected void OnAbortSession(Session session)
/*    */   {
/* 63 */     System.out.println("OnAbortSession " + session);
/* 64 */     this.s = null;
/*    */   }
/*    */ 
/*    */   protected State GetInitState()
/*    */   {
/* 69 */     return State.Get("normal");
/*    */   }
/*    */ 
/*    */   protected String Identification()
/*    */   {
/* 74 */     return "TestClient";
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.TestClientManager
 * JD-Core Version:    0.6.2
 */