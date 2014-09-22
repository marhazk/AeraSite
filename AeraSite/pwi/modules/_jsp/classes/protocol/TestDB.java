/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.Protocol;
/*    */ 
/*    */ public class TestDB
/*    */ {
/* 16 */   public static final Object locker = new Object();
/* 17 */   public static TestClientManager mgr = new TestClientManager();
/*    */ 
/*    */   public static void init() throws Exception
/*    */   {
/* 21 */     synchronized (mgr)
/*    */     {
/* 23 */       if (null == mgr.s)
/*    */       {
/* 25 */         Protocol.Client(mgr);
/* 26 */         mgr.wait();
/*    */       }
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.TestDB
 * JD-Core Version:    0.6.2
 */