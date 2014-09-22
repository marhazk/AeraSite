/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Rpc;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ import java.io.PrintStream;
/*    */ 
/*    */ public final class CanChangeRolename extends Rpc
/*    */ {
/*    */   public int retcode;
/*    */   public int roleid;
/*    */ 
/*    */   public void Server(Rpc.Data argument, Rpc.Data result)
/*    */     throws ProtocolException
/*    */   {
/* 15 */     CanChangeRolenameArg arg = (CanChangeRolenameArg)argument;
/* 16 */     CanChangeRolenameRes res = (CanChangeRolenameRes)result;
/*    */   }
/*    */ 
/*    */   public void Client(Rpc.Data argument, Rpc.Data result) throws ProtocolException
/*    */   {
/* 21 */     CanChangeRolenameArg arg = (CanChangeRolenameArg)argument;
/* 22 */     CanChangeRolenameRes res = (CanChangeRolenameRes)result;
/*    */ 
/* 24 */     synchronized (this)
/*    */     {
/* 26 */       this.retcode = res.retcode;
/* 27 */       if (0 == res.retcode)
/* 28 */         this.roleid = res.roleid;
/*    */       else
/* 30 */         this.roleid = -1;
/* 31 */       System.out.println("CanChangeRolename Client retcode = " + this.retcode);
/* 32 */       notify();
/*    */     }
/*    */   }
/*    */ 
/*    */   public void OnTimeout()
/*    */   {
/* 38 */     synchronized (this)
/*    */     {
/* 40 */       this.retcode = 4;
/* 41 */       this.roleid = -1;
/* 42 */       System.out.println("CanChangeRolename OnTimeout retcode = " + this.retcode);
/* 43 */       notify();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.CanChangeRolename
 * JD-Core Version:    0.6.2
 */